pipeline {
    agent any
    triggers { pullSCM('* * * * *') }
    post { 
        always { 
            deleteDir()
        }
    }
    stages {
        stage('Build') {
            steps {
                withCredentials([usernamePassword(credentialsId: 'github', passwordVariable: 'GIT_PASSWORD', usernameVariable: 'GIT_USERNAME')]) { 
                    echo 'Building..'
		    sh("git tag v0.1")
		    sh("git branch v0.2-rc1")
		    sh("git push https://${GIT_USERNAME}:${GIT_PASSWORD}@github.com/Kimverd/jenkins.git v0.2-rc1")
		}
	    }
        }
    }
}
