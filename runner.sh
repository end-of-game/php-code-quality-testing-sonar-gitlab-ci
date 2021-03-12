#!/usr/bin/zsh

docker run -d -v $(pwd)/config/runner:/etc/gitlab-runner gitlab/gitlab-runner:v13.7.0 register \
  --non-interactive \
  --executor "docker" \
  --docker-image docker:stable \
  --url "http://10.1.1.1/" \
  --registration-token "$(docker exec -it $(docker container ls -f name="sonar_gitlab.1.*" -q) bash -c 'gitlab-rails runner -e production "puts Gitlab::CurrentSettings.current_application_settings.runners_registration_token"')" \
  --description "docker-runner" \
  --tag-list "" \
  --run-untagged="true" \
  --locked="false" \
  --access-level="not_protected"