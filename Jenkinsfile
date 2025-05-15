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
                sh 'ls -la'
            }
        }

        stage('Tests') {
            steps {
                sh 'echo "Running tests..."'
                sh 'vendor/bin/phpunit --testdox'
            }
        }
    }
}