cd public;
rm -r assets images videos index.html vite.svg;
cd ..;
cd upschool_frontend;
npm run build;
cp -r dist/* ../public;
cd ..;
mv public/index.html resources/views/reactApp.blade.php;

