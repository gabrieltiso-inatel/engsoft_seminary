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
        failure {
            mail to: "${env.TEAM_EMAIL}",
                subject: "Failed Pipeline: ${currentBuild.fullDisplayName}",
                body: "Something is wrong with ${env.BUILD_URL}"
        }
        success {
            mail to: "${env.TEAM_EMAIL}",
                subject: "Successful Pipeline: ${currentBuild.fullDisplayName}",
                body: "All the pipeline steps succeded: ${env.BUILD_URL}"
        }        
    }    
}