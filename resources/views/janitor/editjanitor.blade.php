<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body onload="openProfileModal()">

<div class="container mt-5">
  <div class="card p-4 shadow">
    <h3 class="text-center">Edit Profile</h3>

    <!-- Foto Profil -->
    <div class="text-center mb-3">
      <img id="profileImage" src="default-profile.png" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
      <input type="file" id="uploadProfile" accept="image/*" class="form-control mt-2">
    </div>

    <!-- Form Data -->
    <form id="profileForm" onsubmit="saveProfile(); return false;">
      <div class="mb-3">
        <label class="form-label">Nama:</label>
        <input type="text" id="janitornameInput" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">No. Hp:</label>
        <input type="text" id="phoneInput" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" id="emailInput" class="form-control">
      </div>

      <div class="mb-3">
        <label class="form-label">Alamat:</label>
        <input type="text" id="addressInput" class="form-control">
      </div>

      <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
  </div>
</div>

<script>
  function openProfileModal() {
    const savedImage = localStorage.getItem("profileImage");
    const savedJanitorname = localStorage.getItem("janitorname");
    const savedPhone = localStorage.getItem("phone");
    const savedEmail = localStorage.getItem("email");
    const savedAddress = localStorage.getItem("address");

    if (savedImage) document.getElementById("profileImage").src = savedImage;
    if (savedJanitorname) document.getElementById("janitornameInput").value = savedJanitorname;
    if (savedPhone) document.getElementById("phoneInput").value = savedPhone;
    if (savedEmail) document.getElementById("emailInput").value = savedEmail;
    if (savedAddress) document.getElementById("addressInput").value = savedAddress;
  }

  document.getElementById("uploadProfile").addEventListener("change", function(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById("profileImage").src = e.target.result;
        localStorage.setItem("profileImage", e.target.result);
      };
      reader.readAsDataURL(file);
    }
  });

  function saveProfile() {
    const newJanitorname = document.getElementById("janitornameInput").value;
    const newPhone = document.getElementById("phoneInput").value;
    const newEmail = document.getElementById("emailInput").value;
    const newAddress = document.getElementById("addressInput").value;

    localStorage.setItem("janitorname", newJanitorname);
    localStorage.setItem("phone", newPhone);
    localStorage.setItem("email", newEmail);
    localStorage.setItem("address", newAddress);

    alert("Profil berhasil diperbarui!");
  }
</script>

</body>
</html>
