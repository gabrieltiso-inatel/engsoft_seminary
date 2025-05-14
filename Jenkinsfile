pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
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
