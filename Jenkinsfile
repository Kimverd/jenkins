pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
                echo 'Building..'
				sh git tag v0.1
				sh git branch v0.2-rc1
				sh git push origin v0.2-rc1
            }
        }
    }
}