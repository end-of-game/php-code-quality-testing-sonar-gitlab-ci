# Variables
IP_DOCKER_MACHINE=10.1.1.1
COVERAGE_REPORT_PATH=build/coverage.xml
PHPUNIT_REPORT_PATH=build/phpunit.xml
SOURCE_DIR=src/Domain
DOCKER_STACK_NAME=sonar

# Environment variables
.EXPORT_ALL_VARIABLES:
XDEBUG_MODE=coverage

deploy:
	docker stack deploy -c docker-compose.yml ${DOCKER_STACK_NAME}
	
build:
	composer install

tests: build
	./vendor/bin/phpunit \
		--whitelist ${SOURCE_DIR} \
		--log-junit ${PHPUNIT_REPORT_PATH} \
		--coverage-text \
		--coverage-clover ${COVERAGE_REPORT_PATH} \
		--colors=never \
		tests

scan: tests
	sonar-scanner \
		-Dsonar.qualitygate.wait=true \
		-Dsonar.sources=${SOURCE_DIR} \
		-Dsonar.host.url=http://${IP_DOCKER_MACHINE}:9000 \
		-Dsonar.coverage.jacoco.xmlReportPaths=${PHPUNIT_REPORT_PATH} \
		-Dsonar.php.coverage.reportPaths=${COVERAGE_REPORT_PATH} \
		-Dsonar.projectKey=demo-php-code-quality-testing-sonar-gitlab-ci \
		-Dsonar.login=69dd65b4abb7fbd11ff3c05b03eef80bfe191743

clean:
	rm -rf .scannerwork build vendor 

destroy: clean
	docker stack rm ${DOCKER_STACK_NAME}