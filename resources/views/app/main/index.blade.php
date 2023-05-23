@extends('layouts.app')
@section('content')
    <div class="pagetitle">
        <h1>Registro de votos</h1>
    </div>
    <div class=" card">
        <div class="card-body">
            <form class="row g-3 needs-validation p-3" novalidate >
                <h5>Nuevo votante</h5>
                <div class="col-md-2 position-relative">
                    <h6 class="form-label">Nombre</h6>
                    <input type="text" class="form-control" id="name">
                </div>
                <div class="col-md-2 position-relative">
                    <h6 class="form-label">Apellidos</h6>
                    <input type="text" class="form-control" id="lastname">
                </div>
                <div class="col-md-2 position-relative">
                    <h6 class="form-label">CUI</h6>
                    <input type="number" minlength="13" maxlength="15" class="form-control" id="cui">
                </div>
                <div class="col-md-2">
                    <h6 class="form-label">Departamento</h6>
                    <select class="form-select" id="department" onchange="departmentChange('municipality', 'department')">
                        <option selected value="0">Seleccionar</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <h6 class="form-label">Municipio</h6>
                    <select class="form-select" id="municipality" required>
                        <option selected value="0">Seleccionar</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <h6 class="form-label">&nbsp;</h6>
                    <button type="button" class="btn btn-submit rounded-3" onclick="validate()">Guardar</button>
                </div>
            </form>
            <footer class="footer"></footer>
            <div class="row p-3">
                <div class="col-md-2 position-relative">
                    <h6 class="form-label">Consultar CUI</h6>
                    <input type="number" class="form-control" id="cui-search">
                </div>
                <div class="col-md-1 position-relative">
                    <h6 class="form-label">&nbsp;</h6>
                    <button type="button" class="btn btn-submit rounded-3" onclick="searchVoter()">Buscar</button>
                </div>
            </div>
            <form class="row g-3 needs-validation p-3" novalidate >
                <h5>Registrar voto</h5>
                <div class="col-md-3 position-relative">
                    <h6 class="form-label">Nombre</h6>
                    <input type="text" class="form-control" id="voter-name" value="" disabled>
                </div>
                <div class="col-md-2 position-relative">
                    <h6 class="form-label">CUI</h6>
                    <input type="text" class="form-control" id="voter-cui" value="" disabled>
                </div>
                <div class="col-md-3 position-relative">
                    <h6 class="form-label">Departamento y municipio</h6>
                    <input type="text" class="form-control" id="voter-department" value="" disabled>
                </div>
                <div class="col-md-2">
                    <h6 class="form-label">Partido político</h6>
                    <select class="form-select" id="voter-political-parties">
                        <option selected value="0">Seleccione</option>
                        @foreach($political_parties as $politic_party)
                            <option value="{{ $politic_party->id }}">{{ $politic_party->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <h6 class="form-label">&nbsp;</h6>
                    <button type="button" class="btn btn-submit rounded-3" onclick="confirmVote()">Guardar</button>
                </div>
            </form>
            <footer class="footer"></footer>
            <section class="section dashboard p-3">
                <h5>Dashboard</h5>
                <div class="row p-3">
                    <div class="col-md-2 position-relative">
                        <h6 class="form-label">Departamento</h6>
                        <select class="form-select" id="filter-department" onchange="departmentChange('filter-municipality', 'filter-department')">
                            <option selected value="0">Todos</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <h6 class="form-label">Municipio</h6>
                        <select class="form-select" id="filter-municipality" required>
                            <option selected value="0">Todos</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <h6 class="form-label">&nbsp;</h6>
                        <button type="button" class="btn btn-submit rounded-3" onclick="dashboard()">Filtrar</button>
                    </div>
                </div>
                <div class="row">
                    <!-- Left side columns -->
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card sales-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Votos</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-file-signature"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6 id="votes">0</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-md-6">
                                <div class="card info-card revenue-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Votantes</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-users"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6 id="voters">0</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-12">
                                <div class="card info-card customers-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Patidos políticos</h5>
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                                <i class="fa-solid fa-list"></i>
                                            </div>
                                            <div class="ps-3">
                                                <h6 id="political_parties">0</h6>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Reports -->
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Votos por partido político</h5>
                                        <!-- Line Chart -->
                                        <canvas id="myChart"></canvas>
                                        <!-- End Line Chart -->
                                    </div>

                                </div>
                            </div>
                            <!-- End Reports -->
                            <!-- Recent Sales -->
                            <!-- End Recent Sales -->
                        </div>
                    </div>
                    <!-- End Left side columns -->

                    <!-- Right side columns -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body pb-0">
                                <h5 class="card-title">Votos por departamento</h5>
                                <div id="trafficChart" style="min-height: 680px;" class="echart"></div>
                            </div>
                        </div>
                        <!-- End Budget Report -->
                    </div>
                    <!-- End Right side columns -->
                </div>
                <div class="col-16">
                    <div class="card recent-sales ">
                        <div class="card-body">
                            <h5 class="card-title">Votantes recientes</h5>
                            <table class="table table-borderless">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">CUI</th>
                                    <th scope="col">Departamento</th>
                                    <th scope="col">Municipio</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                                </thead>
                                <tbody id="table-body">
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>
    <input type="text" class="form-control" id="voter-id" value="0" hidden="">
@endsection
@push('scripts')
    <script>
        // Form para agregar nuevo votante
        let name = document.getElementById('name')
        let lastname = document.getElementById('lastname')
        let cui = document.getElementById('cui')
        let department = document.getElementById('department')
        let municipality = document.getElementById('municipality')

        // Form para agregar voto
        let voterName = document.getElementById('voter-name')
        let voterCui = document.getElementById('voter-cui')
        let voterId = document.getElementById('voter-id')
        let voterDepartment = document.getElementById('voter-department')
        let politicalParties = document.getElementById('voter-political-parties')

        // Filtros de dashboard
        let filterDepartment = document.getElementById('filter-department')
        let filterMunicipality = document.getElementById('filter-municipality')

        function validate() {
            if (name.value.trim() === '') {
                showAlert('error', 'El nombre es obligatorio')
            } else if (lastname.value.trim() === '') {
                showAlert('error', 'El apellido es obligatorio')
            } else if (cui.value.trim().length < 13 || cui.value.trim().length > 15) {
                showAlert('error', 'El CUI debe tener entre 13 y 15 números')
            } else if (department.value.trim() == 0) {
                showAlert('error', 'Seleccione un departamento')
            } else if (municipality.value.trim() == 0) {
                showAlert('error', 'Seleccione un departamento')
            } else {
                axios.post('{{ route('voters.store') }}', {
                    name: name.value,
                    lastname: lastname.value,
                    cui: cui.value,
                    municipality_id: municipality.value,
                })
                    .then(function (response) {
                        pushVoter(response.data.data)
                        name.value = ''
                        lastname.value  = ''
                        cui.value  = ''
                        municipality.value = 0
                        department.value = 0
                        dashboard()
                        showAlert(response.data.result, response.data.message)
                    })
                    .catch(function (error) {
                        showAlert('error', error.response.data.message)
                    });
            }
        }

        function departmentChange(id_municipality, id_department) {
            let municipality = document.getElementById(id_municipality)
            let department = document.getElementById(id_department)
            let default_option_text = id_municipality === 'municipality' ? 'Seleccionar' : 'Todos'
            axios.get('/main/municipalities?department_id='+department.value)
                .then(function (response) {
                    municipality.innerHTML = ''
                    response.data.forEach(function(item) {
                        const optionElement = document.createElement('option');
                        optionElement.value = item.id;
                        optionElement.text = item.name;
                        municipality.add(optionElement);
                    });
                    const optionElement = document.createElement('option');
                    optionElement.value = 0;
                    optionElement.text = default_option_text
                    municipality.add(optionElement)
                    municipality.value = 0
                    showAlert('success', 'Municipios cargados')
                })
                .catch(function (error) {
                    showAlert('error', 'Ha ocurrido un error')
                })
        }

        function searchVoter() {
            let cuiSearch = document.getElementById('cui-search')
            axios.get('/main/search-voter?cui='+cuiSearch.value)
                .then(function (response) {
                    if (response.data.name) {
                        pushVoter(response.data)
                        cuiSearch.value = ''
                        showAlert('success', 'Votante: '+response.data.name+' '+response.data.lastname)
                    } else {
                        showAlert('error', 'CUI no encotrado')
                    }
                })
                .catch(function (error) {
                    showAlert('error', 'Ha ocurrido un error')
                })
        }

        function pushVoter(voter) {
            voterName.value = voter.name+' '+voter.lastname
            voterCui.value = voter.cui
            voterId.value = voter.id
            voterDepartment.value = voter.municipality.department.name+' - '+voter.municipality.name
        }

        function confirmVote() {
            if (voterId.value.trim() == 0) {
                showAlert('error', 'Seleccione un votante consultando el CUI o cree uno nuevo')
            } else if (politicalParties.value.trim() == 0 ) {
                showAlert('error', 'Seleccione un partido político')
            } else {
                let selectedIndex = politicalParties.selectedIndex;
                let selectedOption = politicalParties.options[selectedIndex].text;
                Swal.fire({
                    title: 'Confirmar voto',
                    text: "Está a punto de emitir un voto al partido "+selectedOption,
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#1f4eec',
                    cancelButtonColor: '#6a6f73',
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('{{ route('main.save-vote') }}', {
                            voter_id: voterId.value,
                            political_party_id: politicalParties.value,
                        })
                            .then(function (response) {
                                voterName.value = ''
                                voterCui.value = ''
                                voterId.value = 0
                                voterDepartment.value = ''
                                politicalParties.value = 0
                                dashboard()
                                showAlert(response.data.result, response.data.message)
                            })
                            .catch(function (error) {
                                showAlert('error', error.response.data.message)
                            });
                    }
                })
            }
        }
        dashboard()
        function dashboard() {
            let votes = document.getElementById('votes')
            let voters = document.getElementById('voters')
            let political_parties = document.getElementById('political_parties')
            axios.get('/main/dashboard?department_id='+filterDepartment.value+'&municipality_id='+filterMunicipality.value)
                .then(function (response) {
                    let data = response.data
                    votes.textContent = data.votes
                    voters.textContent = data.voters
                    political_parties.textContent = data.political_parties

                    let chart = $('#myChart')
                    if (window.grafica) {
                        window.grafica.clear();
                        window.grafica.destroy();
                    }

                    const labels = data.graphics.votes.labels
                    window.grafica = new Chart(chart, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Votos',
                                data: data.graphics.votes.values,
                                borderWidth: 1,
                                backgroundColor: data.graphics.votes.colors,
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                title: {
                                    display: true,
                                    text: 'Votos por partido',
                                },
                            }
                        }
                    });

                    //Grafica de compras
                    echarts.init(document.querySelector("#trafficChart")).setOption({
                        tooltip: {
                            trigger: 'item'
                        },
                        legend: {
                            top: '5%',
                            left: 'center'
                        },
                        series: [{
                            name: 'Votos',
                            type: 'pie',
                            radius: ['40%', '70%'],
                            avoidLabelOverlap: false,
                            label: {
                                show: false,
                                position: 'center'
                            },
                            emphasis: {
                                label: {
                                    show: true,
                                    fontSize: '18',
                                    fontWeight: 'bold'
                                }
                            },
                            labelLine: {
                                show: false
                            },
                            data: data.graphics.departments
                        }]
                    })

                    //LLenar tabla
                    appendTable(data.graphics.voters)
                })
                .catch(function (error) {

                })
        }

        function appendTable(voters) {
            $('#table-body').empty()
            $.each(voters, function (index, value) {
                $('#table-body').append(`
                        <tr>
                            <td>${value.id}</td>
                            <td>${value.name}</td>
                            <td>${value.lastname}</td>
                            <td>${value.cui}</td>
                            <td>${value.municipality.department.name}</td>
                            <td>${value.municipality.name}</td>
                            <td>${ new Date( value.created_at).toLocaleString()}</td>
                        </tr>
                    `)
            })
        }

    </script>
@endpush
