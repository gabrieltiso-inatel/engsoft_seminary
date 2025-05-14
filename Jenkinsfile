pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'chmod +x ./scripts/install_composer.sh'
                sh './scripts/install_composer.sh'
                sh 'composer install'
            }
        }

        stage('Tests') {
            steps {
                sh 'chmod +x ./scripts/run_tests.sh'
                sh './scripts/run_tests.sh'
            }
        }
    }
}
