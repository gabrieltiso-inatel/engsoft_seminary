pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'chmod +x ./scripts/install_composer.sh'
                sh './scripts/install_composer.sh'
                sh 'php composer.phar update'
                sh 'ls -la'
            }
        }

        stage('Tests') {
            steps {
                sh 'ls -la'
                sh 'chmod +x ./scripts/run_tests.sh'
                sh './scripts/run_tests.sh'
            }
        }
    }
}
