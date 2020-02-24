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
    stages {
        stage('Prepair') {
            steps {
		sh 'git clone https://github.com/nodejs/nodejs.org'
	    }
	}
        stage('Build') {
            steps {
		sh 'npm install'
		sh 'npm run build'
	    }
	}
    }
    post {
        success {
            archiveArtifacts artifacts: 'build/'
        }
    }
}
