pipeline {
    agent {
	label 'node'
    }    
	triggers {pollSCM('* * * * *') }
    post { 
        always { 
            deleteDir()
        }
    }
    environment {
	dst_dir = "${sh(script:'/var/www/release/node-`date +%Y-%m-%d-%H-%M`')}"
    }
    stages {
        stage('Prepair') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'github', passwordVariable: 'GIT_PASSWORD', usernameVariable: 'GIT_USERNAME')]) {
			sh label: '', script: '''
			git clone https://github.com/nodejs/nodejs.org $dst_dir
			'''
		}
	    }
	}
	stage('Build') {
	    steps {
		withCredentials([usernamePassword(credentialsId: 'github', passwordVariable: 'GIT_PASSWORD', usernameVariable: 'GIT_USERNAME')]) {
			sh label: '', script: '''
			cd $dst_dir
			npm install
			npm run build
			chown -R nginx: $dst_dir
			ln -sfn $dst_dir/build /etc/nginx/latest
			'''
		}
	    }
	    post {
        	always {
            		archiveArtifacts artifacts: 'build/'
        	}
    	    }
	}
    }
}
