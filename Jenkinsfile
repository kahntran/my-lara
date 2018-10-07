pipeline {
	options {
        disableConcurrentBuilds()
        buildDiscarder(logRotator(numToKeepStr: '5'))
    }
    post { always { deleteDir() } }
	agent any
    stages {
        stage('Build') {
            steps {
                build job: 'Jenkins_create_images/master',  parameters: [
                    string(name: 'SOURCE_DIRECTORY', value: "${WORKSPACE}"),
                    string(name: 'DEPLOY_JOB_NAME', value: "${env.JOB_NAME}")
                ]
            }
        }
        stage('Deploy') {
            steps {
                build job: 'Jenkins_deploy_images/master',  parameters: [
                    string(name: 'SOURCE_DIRECTORY', value: "${WORKSPACE}"),
                    string(name: 'DEPLOY_JOB_NAME', value: "${env.JOB_NAME}"),
                    string(name: 'REPOSITORY', value: "docker-registry.example.lara"),
                    string(name: 'ENVIRONMENT', value: "staging")
                ]
            }
        }
    }
}
