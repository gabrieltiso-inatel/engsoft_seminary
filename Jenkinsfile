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
                sh './vendor/bin/phpunit --testdox --log-junit build/reports/results.xml'
            }
        }
    }
    post {
        always {
            junit 'build/reports/*.xml'
        }
    }    
}