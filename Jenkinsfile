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
                sh './vendor/bin/phpunit --log-junit build/reports/results.xml'
                sh 'ls -l build/reports/' 
            }
        }
    }
    post {
        always {
            junit 'build/reports/*.xml'
        }
    }    
}