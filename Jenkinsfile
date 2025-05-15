pipeline {
    agent any

    stages {
        stage('Checkout') {
            steps {
                git branch: 'main', url: 'https://github.com/gabrieltiso-inatel/engsoft_seminary'
            }
        }

        stage('Build') {
            steps {
                sh 'php composer.phar install'
            }
        }

        stage('Tests') {
            steps {
                sh 'vendor/bin/phpunit --testdox'
            }
        }
    }
}