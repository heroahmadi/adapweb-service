#!/bin/bash
# deploy app
# args: /full/path/to/app_docker_compose.yml app_name docker-swarm-ip /full/path/to/stack/definition.yml http://app_service_target
docker stack deploy -c $1 app
# change alert manager config
docker stack rm monitor

docker secret rm alert_manager_config

echo "route:
  group_by: [service,scale]
  repeat_interval: 1m
  group_interval: 1m
  receiver: 'slack'
  routes:
  - match:
      service: 'exporter_restime-exporter'
      scale: 'up'
    receiver: 'jenkins-exporter_restime-exporter-up'
  - match:
      service: 'exporter_restime-exporter'
      scale: 'down'
    receiver: 'jenkins-exporter_restime-exporter-down'

receivers:
  - name: 'slack'
    slack_configs:
      - send_resolved: true
        title: '[{{ .Status | toUpper }}] {{ .GroupLabels.service }} service is in danger!'
        title_link: 'http://$2:9090/alerts'
        text: '{{ .CommonAnnotations.summary}}'
        api_url: 'https://hooks.slack.com/services/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'
  - name: 'jenkins-exporter_restime-exporter-up'
    webhook_configs:
      - send_resolved: false
        url: 'http://$2:8080/job/service-scale/buildWithParameters?token=DevOps22&service=app_main&scale=1'
  - name: 'jenkins-exporter_restime-exporter-down'
    webhook_configs:
      - send_resolved: false
        url: 'http://$2:8080/job/service-scale/buildWithParameters?token=DevOps22&service=app_main&scale=-1'
" > $3/alert_manager_config.txt

cat $3/alert_manager_config.txt | docker secret create alert_manager_config -
# restart monitor
docker stack deploy -c $3/monitor.yml monitor

# change endpoint of restime-exporter
sed -E "s=http://.*$=$4=g" $3/exporters.yml > $3/new_exporters.yml
docker stack deploy -c $3/new_exporters.yml exporter
# rm $3/new_exporters.yml
