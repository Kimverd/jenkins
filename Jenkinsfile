pipeline {
    agent {
	label 'node'
    }    
    tools {nodejs "nodejs"}
    triggers {pollSCM('* * * * *') }
    stages {
        stage('Prepair') {
            steps {
		git 'https://github.com/nodejs/nodejs.org'
	    }
	}
        stage('Build') {
            steps {
		sh 'npm install'
		sh 'npm run build'
	    }
	    post {
        	success {
            	    archiveArtifacts artifacts: 'build/'
        	}
    	    }
	}
	stage('Deploy') {
	    steps {
		sh label: '', script: '''
		dst_dir="/var/www/release/node-`date +%Y-%m-%d-%H-%M`"
		cp -rf build $dst_dir/
		ln -sfn $dst_dir /etc/nginx/latest
		'''
	    }
	}
    }
}
