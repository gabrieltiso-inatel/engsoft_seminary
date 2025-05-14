pipeline {
    agent any

    stages {
        stage('Tests') {
            steps {
                sh 'chmod +x ./scripts/run_tests.sh'
                sh './scripts/run_tests.sh'
            }
        }
    }
}
