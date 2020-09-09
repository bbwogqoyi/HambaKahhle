# Environment Setup For Tailwindcss and Postcss-cli
- Download and install the [Node v14.x](https://nodejs.org/en/download/)
- Clone the repo to your wamp or xmapp web directory (e.g. 'www')
- Inside the project directory open cmd/terminal and, install dependencies:
 ``npm install``
 - To enable live-reloading install live-server: ``npm run init-server``
 - Launch the server, to view website and you edit the files and changes should reflectin seconds: ``npm run dev`` 

# Start New Postcss-CLI 
- Create a project folder, initialize npm: ``mkdir myproj1 && cd myproj1 && npm init -y``
- Install tailwind, postcss (for processing) and autoprefixer (adds vendor prefixes to your code): ``npm install tailwindcss postcss-cli autoprefixer``
- Create a tailwind config file ``(tailwind.config.js)``: npx tailwind init
- Create a ``postcss.config.js`` file, and copy the exports from below: ``nano postcss.config.js``
- Create a the tailwind css file & directory, and copy the includes from below: ``mkdir css && nano css/tailwind.css``
- Add a build script to package.json: ``"build": "postcss css/tailwind.css -o public/build/tailwind.css"``
- Build the files: ``npm run build``
- Create your index.html file, and include the built css: <link rel="stylesheet" href="build/tailwind.css">
- Follow the [Tailwind CSS docs](https://tailwindcss.com/) and get designing!