pipeline {
    agent any

    environment {
        TEAM_EMAIL = 'diego.rodrigues@ges.inatel.br'
    }

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
                sh './vendor/bin/phpunit --testdox --log-junit build/reports/report.xml'
                sh 'cat build/reports/report.xml'
            }
        }
    }

    post {
        always {
            archiveArtifacts artifacts: 'build/reports/report.xml', fingerprint: true
            junit 'build/reports/report.xml'
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