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
                sh 'echo "Building the project..."'
                sh 'chmod +x ./scripts/install_composer.sh'
                sh './scripts/install_composer.sh'
                sh 'php composer.phar install'
                sh 'ls -la'
            }
        }

        stage('Tests') {
            steps {
                sh 'echo "Running tests..."'
                sh 'ls -la'
                sh 'php composer.phar install'
                sh 'vendor/bin/phpunit --testdox'
            }
        }
    }
}