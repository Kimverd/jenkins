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
		sh 'dst_dir="/var/www/release/node-`date +%Y-%m-%d-%H-%M`"'
		copyArtifacts filter: 'archive.zip', fingerprintArtifacts: true, projectName: '${JOB_NAME}', selector: specific('${BUILD_NUMBER}')
		unzip zipFile: 'archive.zip', dir: '$dst_dir'
	    }
	}
    }
}
