<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>111</title>
    
    <script src="https://threejs.org/build/three.js"></script>
    <script src="{{ asset('js/stats.js') }}"></script>
    <script src="{{ asset('js/dat.gui.js') }}"></script>
    <script src="https://threejs.org/examples/js/controls/OrbitControls.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <style>
    body { margin: 0; }
    canvas { width: 70vw !important; height: 70vh !important; display: block; }
    button { font-size: 30px; }
    </style>
</head>
<body>
    <script>
        $.ajax({
          type: "GET",
          url: "http://localhost:2020/api/robot",
        }).done((data) => {
            console.log(data);
            options.amarillo = data.amarillo
            options.rojo = data.rojo
            options.rosa = data.rosa
            options.naranja = data.naranja
        }).fail(function (jqXHR, textStatus, errorThrown) {
            console.error(jqXHR);
        });

        var options = {
            amarillo: 0,
            rojo: 0,
            rosa: 0,
            naranja: 0,
        };

        var gui = new dat.GUI();
        gui.add(options, 'amarillo', 0, 7).listen();
        gui.add(options, 'rojo', 0, 7).listen();
        gui.add(options, 'rosa', 0, 7).listen();
        gui.add(options, 'naranja', 0, 7).listen();
        // escena y cámara
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera( 100, window.innerWidth / window.innerHeight, 0.1, 1000 );
        camera.position.x = 0.2;
        camera.position.y = 7.7;
        camera.position.z = 24;
        // camera.lookAt(new THREE.Vector3(0, 0, 0));
        const renderer = new THREE.WebGLRenderer();
        renderer.setSize( window.innerWidth, window.innerHeight );
        document.body.appendChild( renderer.domElement );

        // camara que gira con el click del raton
        var controls = new THREE.OrbitControls( camera, renderer.domElement );
        controls.target.set( 0, 0, 0 );



        // cube 1
        const geometry = new THREE.CylinderGeometry(2,2,7,9);
        const material = new THREE.MeshBasicMaterial( {color: 0xffff00, wireframe:true, wireframeLinewidth:10} );
        const yellow = new THREE.Mesh( geometry, material );


        // cube 2
        const geometry2 = new THREE.CylinderGeometry(2,2,5,9);
        const material2 = new THREE.MeshBasicMaterial( {color: 0xf11f00, wireframe:true, wireframeLinewidth:10} );
        const red1 = new THREE.Mesh( geometry2, material2 );

        red1.position.y = yellow.position.y+0.5
        red1.position.x = yellow.position.x+5
        red1.rotation.z = 1.6
        // cube 3
        const geometry3 = new THREE.CylinderGeometry(2,2,11,9);
        const material3 = new THREE.MeshBasicMaterial( {color: 0xf11f00, wireframe:true, wireframeLinewidth:10} );
        const red2 = new THREE.Mesh( geometry3, material3 );
        
        red2.position.y = red1.position.y+5
        red2.position.x = red1.position.x+3.5

        // cube 2 2
        const geometry4 = new THREE.CylinderGeometry(2,2,5,9);
        const material4 = new THREE.MeshBasicMaterial( {color: 0xf116b1, wireframe:true, wireframeLinewidth:10} );
        const pink1 = new THREE.Mesh( geometry4, material4 );

        pink1.position.y = red2.position.y+4.2
        pink1.position.x = red2.position.x-3
        pink1.rotation.z = 1.6
        // red2.rotation.x = 1.6

        // cube 3 2
        const geometry5 = new THREE.CylinderGeometry(2,2,11,9);
        const material5 = new THREE.MeshBasicMaterial( {color: 0xf116b1, wireframe:true, wireframeLinewidth:10} );
        const pink2 = new THREE.Mesh( geometry5, material5 );
        
        pink2.position.y = pink1.position.y+5
        pink2.position.x = pink1.position.x-3

       // cube 2 3
       const geometry6 = new THREE.CylinderGeometry(2,2,5,9);
        const material6 = new THREE.MeshBasicMaterial( {color: 0xffa500, wireframe:true, wireframeLinewidth:10} );
        const orange1 = new THREE.Mesh( geometry6, material6 );

        orange1.position.y = pink2.position.y-5
        orange1.position.x = pink2.position.x+1
        orange1.rotation.z = 1.6
        
        // cube 3 3
        const geometry7 = new THREE.CylinderGeometry(2,2,6,9);
        const material7 = new THREE.MeshBasicMaterial( {color: 0xffa500, wireframe:true, wireframeLinewidth:10} );
        const orange2 = new THREE.Mesh( geometry7, material7 );
        
        orange2.position.y = orange1.position.y+1.5
        orange2.position.x = orange1.position.x+3.5
        // scene.add(yellow,red,pink,red2,pink2, red3,pink3);
        // window.cube = yellow

        var orangeGroup = new THREE.Group();
        orangeGroup.position.y =orange1.position.y-20
        orangeGroup.add(orange2)
        orangeGroup.add(orange1)
        
        var pivotGroup = new THREE.Object3D();
        pivotGroup.position.y = orange1.position.y+9
        pivotGroup.position.x = orange1.position.x
        pivotGroup.add( orangeGroup );


        var pinkGroup = new THREE.Group();
        pinkGroup.position.y = pink1.position.y-20
        pinkGroup.position.x = pink1.position.x-12
        pinkGroup.add(pink2)
        pinkGroup.add(pink1)
        pinkGroup.add(pivotGroup)
       
        var pinkPivot = new THREE.Object3D();
        pinkPivot.position.y = pink1.position.y
        pinkPivot.position.x = pink1.position.x
        pinkPivot.add( pinkGroup );

        var redGroup = new THREE.Group();
        redGroup.position.y = yellow.position.y
        redGroup.position.x = yellow.position.x-5
        redGroup.add(red2)
        redGroup.add(red1)
        redGroup.add(pinkPivot)
       
        var redPivot = new THREE.Object3D();
        redPivot.position.y = red1.position.y+1
        redPivot.position.x = red1.position.x-0.5
        redPivot.add( redGroup );

        var all =  new THREE.Group();

        all.add(yellow)
        all.add(redPivot)

       
        scene.add(all);

        window.camera = camera

        function animate() {
            requestAnimationFrame( animate );
            controls.update();
            // Hago un emit el usuario rota un eje
            // if (all.rotation.y != options.amarillo) {
            //     socket.emit('update', {color: "amarillo", pos:options.amarillo});
            // }
            // if (redPivot.rotation.x != options.rojo) {
            //     socket.emit('update', {color: "rojo", pos:options.rojo});
            // }
            // if (pinkPivot.rotation.x != options.rosa) {
            //     socket.emit('update', {color: "rosa", pos:options.rosa});
            // }
            // if (pivotGroup.rotation.x != options.naranja) {
            //     socket.emit('update', {color: "naranja", pos: Math.round(options.naranja* 100) / 100});
            // }

            
            redPivot.rotation.x = options.rojo
            pinkPivot.rotation.x = options.rosa;
            pivotGroup.rotation.x = Math.round(options.naranja* 100) / 100;
            all.rotation.y = options.amarillo;

            renderer.render( scene, camera );
        };

        function update() {
            for (const [axis, grados] of Object.entries(options)) {
                $.ajax({
                    type: "POST",
                    url: "https://robot2.nullpointer.cat/api/update/"+axis+"/"+grados,
                }).done((data) => {
                    console.log(data);
                    options.amarillo = data.amarillo
                    options.rojo = data.rojo
                    options.rosa = data.rosa
                    options.naranja = data.naranja
                }).fail(function (jqXHR, textStatus, errorThrown) {
                    console.error(jqXHR);
                });
            }
        }

        function get() {
            $.ajax({
            type: "GET",
            url: "http://localhost:2020/api/robot",
            }).done((data) => {
                console.log(data);
                options.amarillo = data.amarillo
                options.rojo = data.rojo
                options.rosa = data.rosa
                options.naranja = data.naranja
            }).fail(function (jqXHR, textStatus, errorThrown) {
                console.error(jqXHR);
            });            

        }

        {{-- window.setInterval(get, 5000);
        window.setInterval(update, 20000); --}}

        animate();
    </script>
    <button onclick="update()">Subir posiciones brazo al servidor</button>
    <br>
    <button onclick="get()">Bajar posiciones brazo del servidor</button>


</body>
</html>
