pipeline {
    agent any
	triggers {pollSCM('* * * * *') }
    post { 
        always { 
            deleteDir()
        }
    }
    stages {
        stage('Prepair') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'github', passwordVariable: 'GIT_PASSWORD', usernameVariable: 'GIT_USERNAME')]) {
			step {
				sh label: '', script: '''
				dst_dir="/var/www/release/node-`date +%d-%m-%Y-%k-%M`"
				git clone https://github.com/nodejs/nodejs.org $dst_dir
				'''
			}
		}
	    }
	}
	stage('Build') {
	    steps {
		withCredentials([usernamePassword(credentialsId: 'github', passwordVariable: 'GIT_PASSWORD', usernameVariable: 'GIT_USERNAME')]) {
			step {
				sh label: '', script: '''
				cd $dst_dir
				npm install
				chown -R nginx: $dst_dir
				ln -sfn $dst_dir/build /etc/nginx/latest
				'''
			}
		}
	    }
	}
    }
}
