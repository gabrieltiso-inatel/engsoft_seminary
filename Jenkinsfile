pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                sh 'composer install'
                sh 'composer dump-autoload -o'
            }
        }

        stage('Tests') {
            steps {
                sh 'mkdir -p build/reports'
                sh './vendor/bin/phpunit --log-junit build/reports/results.xml'
            }
        }
    }
    post {
        always {
            junit 'build/reports/results.xml'
        }
    }    
}