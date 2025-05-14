pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh './scripts/install_composer.sh'
                sh "composer install"
            }
        }

        stage('Tests'){
            steps{
                sh './scripts/run_tests.sh'
            }
        }
    }
}
