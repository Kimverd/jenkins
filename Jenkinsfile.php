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
                dst_dir="/var/www/release/php-`date +%Y-%m-%d-%H-%M`"
                cp -rf . $dst_dir/
                chmod -R 777  $dst_dir/var/
                ln -sfn $dst_dir/public /etc/nginx/php-latest
                '''
            }
        }
    }
}
