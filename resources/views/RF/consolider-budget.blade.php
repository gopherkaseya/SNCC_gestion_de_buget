@extends('base')
@section('title')
    Acceuil Chef Departement
@endsection

@section('main-content')
    @include('components.aside-rf')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
          <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Preparation du budget</li>
              </ol>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-2">

          <div class="row">

            <div class="col-md-5 mt-4">
              <div class="card">
                <div class="card-header pb-0 px-3">
                  <h6 class="mb-0">Formulaire de consolidation du budget</h6>
                </div>
                <div class="card-body pt-4 p-3">
                  <form id="budgetForm">
                    <div id="besoinsContainer">
                      <!-- Les besoins seront ajoutés dynamiquement ici -->
                    </div>

                    <hr>
                    <div class="mb-3">
                      <h6>Budget Total : <span id="totalBudget">0</span> FC</h6>
                    </div>
                    <button type="submit" class="btn btn-success">Consolider</button>
                  </form>
                </div>
              </div>
            </div>


          </div>
          <footer class="footer py-4  ">

          </footer>
        </div>
      </main>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const budgetForm = document.getElementById("budgetForm");
            const totalBudgetElement = document.getElementById("totalBudget");
            const consoliderButton = budgetForm.querySelector("button[type='submit']");
            const loadingSpinner = document.createElement("span");

            // Création du bouton "Soumettre au DG"
            const submitDGButton = document.createElement("button");
            submitDGButton.type = "button";
            submitDGButton.classList.add("btn", "btn-primary", "d-none");
            submitDGButton.textContent = "Soumettre au DG";

            // Spinner de chargement
            loadingSpinner.classList.add("spinner-border", "spinner-border-sm", "ms-2", "d-none");
            consoliderButton.appendChild(loadingSpinner);

            // Ajout du bouton "Soumettre au DG" après le formulaire
            budgetForm.appendChild(submitDGButton);

            budgetForm.addEventListener("submit", function (event) {
                event.preventDefault();
                
                // Afficher le chargement
                consoliderButton.disabled = true;
                loadingSpinner.classList.remove("d-none");

                fetch("{{ route('RF.consolider') }}", {
                    method: "GET",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    totalBudgetElement.textContent = data + " FC";

                    // Afficher le bouton "Soumettre au DG" après la consolidation
                    submitDGButton.classList.remove("d-none");
                })
                .catch(error => console.error("Erreur :", error))
                .finally(() => {
                    setTimeout(() => {
                        consoliderButton.disabled = false;
                        loadingSpinner.classList.add("d-none");
                    }, 2000);
                });
            });

            // Gestion du clic sur "Soumettre au DG"
            submitDGButton.addEventListener("click", function () {
                submitDGButton.disabled = true;
                submitDGButton.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Envoi en cours...`;

                fetch("", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ totalBudget: totalBudgetElement.textContent })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    submitDGButton.innerHTML = "Envoyé avec succès ✅";
                })
                .catch(error => {
                    console.error("Erreur :", error);
                    submitDGButton.innerHTML = "Erreur ❌";
                    submitDGButton.disabled = false;
                });
            });
        });
    </script>
@endsection


