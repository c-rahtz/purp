(function($) {

    var scene, camera, renderer, geometry, material, mesh, initCanvas;

    initCanvas = function() {
        var canvas = document.getElementById("header-canvas");
        scene = new THREE.Scene();
        // scene.background = new THREE.Color( 0xffffff);
        camera = new THREE.PerspectiveCamera(75, canvas.offsetWidth / canvas.offsetHeight, 1, 10000);
        // camera.position.z = 100;
        // camera.position.x = 200;
        // camera.rotation.y = -5;

        geometry = new THREE.BoxGeometry(200, 200, 200);
        material = new THREE.MeshBasicMaterial({ color: 0x32004b, wireframe: true });

        mesh = new THREE.Mesh(geometry, material);
        // mesh.position.x = -200;
        scene.add(mesh);

        renderer = new THREE.WebGLRenderer( {alpha: true } );
        renderer.setSize(canvas.offsetWidth, canvas.offsetHeight);

        canvas.appendChild(renderer.domElement);
    };

    function animate() {

        requestAnimationFrame(animate);

        mesh.rotation.x += 0.01;
        mesh.rotation.y += 0.02;

        renderer.render(scene, camera);
    }



    $(document).ready(function() {
        $(".identity-wrap").prepend("<div id='header-canvas'></div>");
        initCanvas();
        animate();
    });


})(jQuery);
