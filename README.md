# Perfil de Usuário - API

## Sobre o Projeto

O projeto trata-se de uma API Restful que gerencia perfis de usuários.

Você pode acessar o código-fonte do front-end neste repositório:  
[MichelNsouza/front.perfil-usuario](https://github.com/MichelNsouza/front.perfil-usuario)

## Tecnologias Utilizadas

* **Laravel** (v11+) – Deploy no Vercel
* **MySQL** – FreeHostia
* **Cloudinary** – CDN de gerenciamento de mídia na nuvem
  
## Deploy

Você pode testar a API acessando [aqui](https://api-perfil-usuario.vercel.app/api/api/usuarios)

## Instalação e Execução Local

### Pré-requisitos:

* PHP 8.1+
* Composer
* MySQL

### Passos:

#### Clone o repositório
```bash
git clone https://github.com/MichelNsouza/api.perfil-usuario.git
```
#### Navegue ate o projeto
```bash
cd api.perfil-usuario
```
#### Mude para branch develop, pois a versão da main utiliza o serviço da Cloudinary
```bash
git checkout -b develop origin/develop
```
#### Copie o .env de exemplo e configure suas credenciais
```bash
cp .env.example .env
```
#### Configure seu banco de dados
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=XPTO
DB_USERNAME=XPTO
DB_PASSWORD=XPTO
```
#### Configure o disco público no .env
```bash
FILESYSTEM_DISK=public
```
#### Garanta que o link simbólico esteja criado:
```bash
# Assim A imagem será salva em storage/app/public/fotos_perfil
php artisan storage:link
```
#### Instale as dependências PHP
```bash
composer install
```
#### Gere a key da aplicação
```bash
php artisan key:generate
```
#### execute as migrations
```bash
php artisan migrate
```
#### Execute o servidor local

```bash
php artisan serve
```

A API estará disponível em: `http://localhost:8000/api`


## Endpoints

1. **Listar usuários**
   `GET /usuarios`

2. **Criar usuário**
   `POST /usuarios`

3. **Visualizar usuário**
   `GET /usuarios/{id}`

4. **Atualizar usuário**
   `PUT/PATCH /usuarios/{id}`

5. **Deletar usuário**
   `DELETE /usuarios/{id}`

6. **Atualizar foto de perfil**
   `POST /usuarios/{id}/foto`
   *(multipart/form-data com campo `foto_perfil`)*

#### Modelo JSON:

```json
{
  "nome_completo": "Cebolinha da Silva",
  "idade": 7,
  "rua": "Lua do Limoeilo",
  "bairro": "Limoeiro",
  "estado": "GIBI",
  "biografia": "Plincipe dos planos infalíveis! Futulo dono da lua!"
  "foto_perfil": file
}

```

---

## License

O framework Laravel é licenciado sob a [MIT license](https://opensource.org/licenses/MIT).

