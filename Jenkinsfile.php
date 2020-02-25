pipeline {
    agent {
        label 'node'
    }    
    triggers {pollSCM('* * * * *') }
    tools {nodejs "nodejs"}
    post { 
        always { 
            deleteDir()
        }
    }
    stages {
        stage('Prepair') {
            steps {
                git 'https://github.com/symfony/symfony-demo'
            }
        }
        stage('Build') {
            steps {
                sh 'php74 /bin/composer install'
            }
        }
        stage('Deploy') {
            steps {
                sh label: '', script: '''
                dst_dir="/var/www/release/node-`date +%Y-%m-%d-%H-%M`"
                cp -rf . $dst_dir/
                ln -sfn $dst_dir/public /etc/nginx/php-latest
                '''
            }
        }
    }
}
