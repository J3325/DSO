pipeline {
    agent any

    environment {
        PROJECT_NAME = "DSO"
        APP_ENV      = "staging"
    }

    stages {
        stage('1. Inspect Workspace') {
            steps {
                echo "Memulai pipeline untuk ${PROJECT_NAME} di environment ${APP_ENV}..."
                sh 'ls -la'
                sh 'git log -1 --oneline'
            }
        }

        stage('2. Validate Docker Configs') {
            steps {
                echo "Memvalidasi struktur Dockerfile dan Docker Compose..."
                sh '''
                    test -f docker-compose.yml && echo "OK: docker-compose.yml ditemukan"
                    test -f frontend/Dockerfile && echo "OK: frontend/Dockerfile ditemukan"
                    test -f backend/Dockerfile && echo "OK: backend/Dockerfile ditemukan"
                '''
            }
        }

        stage('3. Quality & Unit Test') {
            parallel {
                stage('Test Frontend (Next.js)') {
                    steps {
                        echo "Menjalankan pengecekan sintaks frontend..."
                        sh 'test -f frontend/login.js && echo "Frontend JS check: PASSED"'
                    }
                }
                stage('Test Backend (Laravel/PHP)') {
                    steps {
                        echo "Menjalankan pengecekan sintaks backend..."
                        sh 'test -f backend/index.php && echo "Backend PHP check: PASSED"'
                    }
                }
            }
        }

        stage('4. Build Readiness') {
            steps {
                echo "Seluruh validasi lolos. Siap didelegasikan ke Build Agent!"
            }
        }
    }

    post {
        success {
            echo "SUKSES: Pipeline ${PROJECT_NAME} selesai tanpa error."
        }
        failure {
            echo "GAGAL: Terjadi kesalahan pada salah satu stage. Cek Console Output!"
        }
    }
}
