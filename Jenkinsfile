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
    }
}
