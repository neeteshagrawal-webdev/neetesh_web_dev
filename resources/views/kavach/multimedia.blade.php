@include('includes.header')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="card-container">
        <div class="card-header">
            <i class="fas fa-train"></i> Kavach -- Multimedia
        </div>
        <div class="video-grid">
        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>🚆 Kavach Demo to Honorable Prime Minister</h3>
        </div>
        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>🔧 Kavach with WAG-9 (LE-MU) & CCB</h3>
        </div>
        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>🏛️ Railway Minister's Visit to Kavach Lab</h3>
        </div>
        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>⚠️ Kavach Core R&D - SoS from Station</h3>
        </div>
        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>📢 Kavach LC Gate Approach Whistle</h3>
        </div>
        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>🛑 Kavach Coasting Based Braking</h3>
        </div>
        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>🎤 Kavach Field PoC - Demo to CRB Media</h3> 
        </div>
        <div class="video-card">
            <video controls>
             <source src="video.mp4" type="video/mp4">
            </video>
            <h3>🎤 Kavach Core R&D SPAD Prev Sample</h3>
        </div>
        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>🎤 Kavach Core R&D Multi-vendor Interoperability - Kernex Loco at Medha Stn</h3>
        </div>
        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>🎤 Kavach Core R&D Continuous Update Delayed Clearance</h3>
        </div>
        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>🎤 Kavach Core R&D Sample</h3>
        </div>
        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>🎤 Kavach Field PoC - Two Train on same Track - Head-on Collision Prevention</h3>
        </div>
        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>🎤  Kavach Field PoC - Two Train on same Track - Head-on Collision Prevention</h3>
        </div>
        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>🎤  Kavach in Auto Signal without Station-to-Station Communication without Block Section RF Tower</h3>
        </div>

        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>🎤  Kavach Prototype Testing in Field through Simulator</h3>
        </div>

        <div class="video-card">
            <video controls>
                <source src="video.mp4" type="video/mp4">
            </video>
            <h3>🎤  KAVACH 8 min Final MR</h3>
        </div>
        </div>

    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>


    .card-container {
    max-width: 1200px;
    margin: 50px auto;
    padding: 20px;
    background: white;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    }

    .card-header {
    font-size: 24px;
    font-weight: bold;
    color: #333;
    padding: 15px;
    border-bottom: 2px solid #ddd;
    display: flex;
    align-items: center;
    gap: 10px;
    }

    .card-header i {
    color: #ff6600;
    font-size: 26px;
    }

    .video-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    padding: 20px;
    }

    .video-card {
    background: white;
    border-radius: 10px;
    padding: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s;
    }

    .video-card:hover {
    transform: translateY(-5px);
    }

    .video-card h3 {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    margin-top: 10px;
    }

    video {
    width: 100%;
    height: auto;
    border-radius: 10px;
    outline: none;
    }

    @media (max-width: 768px) {
    .video-grid {
    grid-template-columns: repeat(auto-fit, minmax(100%, 1fr));
    }
    }
    </style>


    </div>
</div>

@include('includes.footer')