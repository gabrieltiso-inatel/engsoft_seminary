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
                sh './vendor/bin/phpunit --testdox'
            }
        }
    }
}