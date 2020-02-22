pipeline {
    agent any
	triggers {pullSCM('* * * * *') }
    post { 
        always { 
            deleteDir()
        }
    }
    stages {
        stage('Build') {
            steps {
              	withCredentials([usernamePassword(credentialsId: 'github', passwordVariable: 'GIT_PASSWORD', usernameVariable: 'GIT_USERNAME')]) {
		    sh label: '', script: '''tag_version=`git ls-remote --tags https://github.com/Kimverd/jenkins.git | awk -F \'/\' \'{ print $3}\'`
		    dst_dir=/var/www/site/$tag_version
		    mkdir -p $dst_dir
		    git clone https://github.com/Kimverd/jenkins $dst_dir
		    ln -sfn $dst_dir /etc/nginx/latest'''
		}
            }
        }
    }
}
