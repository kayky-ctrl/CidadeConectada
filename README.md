# 🏙️ CityConnect - Plataforma de Gestão Urbana

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

## 🌟 Visão Geral
Sistema completo para reporte e gestão de problemas urbanos com:
- Interface cidadã
- Painel administrativo
- API RESTful

## 🚀 Funcionalidades

### 👨‍💻 Para Cidadãos
- 📝 Reporte de problemas com fotos
- 📊 Acompanhamento em tempo real
- ⭐ Sistema de avaliação

### 🏛️ Para Gestores
- 🔐 Área administrativa segura
- 📋 Dashboard completo
- 🔄 Fluxo de trabalho

## 💻 Instalação

```bash
# Clone o repositório
git clone https://github.com/kayky-ctrl/CidadeConectada
cd cityconnect

# Instale as dependências
composer install

# Configure o ambiente
cp .env.example .env
php artisan key:generate
```

## ⚙️ Configuração

Configure o banco de dados no .env:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=city_maintenance
DB_USERNAME=root
DB_PASSWORD=
```

## 🖥️ Uso

### Iniciando o Servidor
Para iniciar o servidor de desenvolvimento, execute:

```bash
php artisan serve
```

## 🌐 Acessando a Aplicação

### Interface do Cidadão
[🌐 http://localhost:8000](http://localhost:8000)  
_Área pública para reportar e acompanhar problemas urbanos_

### Painel Administrativo 
[🔐 http://localhost:8000/issuesAdmin](http://localhost:8000/issuesAdmin)  
_Área restrita para gestão pela administração pública_

## 🔑 Credenciais de Teste

| Tipo de Acesso       | Email                 | Senha     |
|----------------------|-----------------------|-----------|
| 👤 Usuário Comum     | usuario@exemplo.com   | password  |
| 👔 Administrador     | admin@example.com     | 12345678  |

**⚠️ Importante:**  
Estas credenciais são apenas para ambiente de desenvolvimento. Recomenda-se:
1. Alterar todas as senhas em produção
2. Utilizar autenticação de dois fatores
3. Limitar tentativas de login

## 📂 Estrutura
```text
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/
│   │   └── Web/
├── Models/
config/
database/
├── migrations/
├── seeders/
public/
resources/
├── views/
routes/
├── api.php
└── web.php
```

## 🔌 API

| Método | Rota                   | Descrição               |
|--------|------------------------|-------------------------|
| POST   | `/register`            | Registrar usuário       |
| POST   | `/login`               | Login                   |
| GET    | `/issues`              | Listar issues           |
| POST   | `/issues`              | Criar issue             |
| POST   | `/issues/{id}/rate`    | Avaliar issue           |
| POST   | `/issuesAdmin`         | Ver issues Admin        |
| POST   | `/issues/2/rate`       | Fazer avaliações        |


## 🌐 Rotas Web

### Públicas
- `/` - Página inicial (Home)
- `/login` - Página de login
- `/register` - Página de registro

### Área Autenticada
- `/issues` - Lista de reports do usuário
- `/issues/create` - Criar novo reporte

### Área Administrativa
- `/issuesAdmin` - Gerenciamento de reports

## 📜 Licença

Este projeto está licenciado sob a **Licença MIT**. Consulte o arquivo [LICENSE](LICENSE) para mais detalhes.

## ✉️ Contato

**Desenvolvido por:**  
Kayky  
📧 Kaykyrdepaula@gmail.com  

## 💡 Dicas para Produção

Para otimizar a aplicação em ambiente de produção, execute:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
