/*node {

  stage('Checkout') {
    git url: 'https://github.com/Ingbeto/liquorstore.git',branch: 'main'
  }  
  stage('Build'){
      
      bat 'composer install'
  }
  stage('Clean') {
    bat 'php artisan config:clear'
    bat 'php artisan config:cache'
  }
  
  stage('Migrations') {
    bat 'php artisan migrate'
  }

  stage ('Test') {
    bat "vendor/bin/phpunit"
    mstest testResultsFile:"**/ /*.trx", keepLongStdio: true
  }
    

  stage('Publish') {
    bat ''
  } 
  
} */

pipeline {
agent any

stages {

  stage('Checkout') {
    git url: 'https://github.com/Ingbeto/liquorstore.git',branch: 'main'
  } 

  stage('Build') {
      steps {
          bat 'composer install --no-interaction'
      }
  }
  stage('Test') {
      steps {
          bat './vendor/bin/phpunit'
      }
  }

  stage('Public'){
    steps{
      bat 'start chrome http://licoreria_l6.test/home'
    }
  }

}
}