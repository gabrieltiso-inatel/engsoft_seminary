pipeline {
    agent any

    stages {
        stage('Tests') {
            steps {
                sh 'phpunit tests --testdox --colors=always --coverage-html coverage --stop-on-failure'
                // sh './scripts/run_tests.sh'
            }
        }
    }
}
