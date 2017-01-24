(function($) {

    var scene, camera, renderer, geometry, material, mesh, initCanvas;

    initCanvas = function() {
        var canvas = document.getElementById("header-canvas");
        scene = new THREE.Scene();
        // scene.background = new THREE.Color( 0xffffff);
        camera = new THREE.PerspectiveCamera(45, canvas.offsetWidth / canvas.offsetHeight, 0.1, 1000);
        camera.position.z = 100;
        // camera.position.x = 200;
        // camera.rotation.y = -5;

        geometry = new THREE.BoxGeometry(10, 10, 10);
        geometryTwo = new THREE.BoxGeometry(7, 7, 7);
        material = new THREE.MeshBasicMaterial({ color: 0x32004b, transparent: true, opacity: 0.5 });
        materialTwo = new THREE.MeshBasicMaterial({ color: 0x32444b, transparent: true, opacity: 0.5 });

        mesh = new THREE.Mesh(geometry, material);
        meshTwo = new THREE.Mesh(geometryTwo, materialTwo);
        // mesh.position.x = -200;
        meshTwo.position.x = -10;
        meshTwo.position.z = -10;
        scene.add(mesh);
        scene.add(meshTwo);

        renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        renderer.setSize(canvas.offsetWidth, canvas.offsetHeight);

        canvas.appendChild(renderer.domElement);
    }

    function animate() {

        requestAnimationFrame(animate);

        mesh.rotation.x += 0.01;
        mesh.rotation.y += 0.02;

        meshTwo.rotation.x += 0.02;
        meshTwo.rotation.y += 0.03;

        // camera.rotation.y -= 0.005;

        renderer.render(scene, camera);
    }



    $(document).ready(function() {
        $(".identity-wrap").prepend("<div id='header-canvas'></div>");
        initCanvas();
        animate();
    });


})(jQuery);
