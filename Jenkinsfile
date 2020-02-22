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
		    sh("dst_dir=/var/www/site/\$(git ls-remote --tags https://github.com/Kimverd/jenkins.git | awk -F '/' '{ print $3}'))
		    sh("mkdir -p /var/www/site/$tag_version)
		    sh("git clone https://github.com/Kimverd/jenkins $dst_dir)
		    sh("ln -sfn $dst_dir /etc/nginx/latest)
		}
            }
        }
    }
}
