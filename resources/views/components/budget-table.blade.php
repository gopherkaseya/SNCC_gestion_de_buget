<table class="table align-items-center mb-0">
    <thead>
    <tr>
        <th>Département</th>
        <th>Besoins</th>
        <th class="text-center">Date soumission</th>
        <th class="text-center">Statut</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($budgets as $budget)
        <tr>
            <td><h6 class="mb-0 text-sm">{{ $budget->nom_departement }}</h6></td>
            <td>
                <p class="text-xs mb-0">{{ $budget->description }}</p>
                <p class="text-xs text-secondary mb-0">Montant : {{ number_format($budget->montant, 2, ',', ' ') }} FC</p>
            </td>
            <td class="text-center">{{ $budget->created_at ? $budget->created_at->format('d/m/Y') : '--' }}</td>
            <td class="text-center">
                @php
                    $badgeClass = match($budget->statut) {
                        'Complet' => 'bg-success text-white',
                        'Incomplet' => 'bg-warning text-dark',
                        'Non soumis' => 'bg-danger text-white',
                        'Consolidé et non soumis' => 'bg-secondary text-white',
                        default => 'bg-secondary text-white'
                    };
                @endphp
                <span class="badge {{ $badgeClass }} text-xs">{{ $budget->statut }}</span>
            </td>
            <td class="align-middle">
                <a href="#" class="text-secondary font-weight-bold text-xs">
                    {{ $budget->statut === 'Non soumis' ? 'Relancer' : 'Voir' }}
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
