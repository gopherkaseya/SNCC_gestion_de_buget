<table class="table align-items-center mb-0">
    <thead>
    <tr>
        <th>Département</th>
        <th>Montant</th>
        <th class="text-center">Date soumission</th>
        <th class="text-center">Statut</th>
        <th class="text-center"> Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($budgets as $budget)
        <tr>
            <td>
                <h6 class="mb-0 text-sm">{{ $budget->nom_departement }}</h6>
            </td>
            <td>
                <p class="text-xs text-secondary mb-0">
                    {{ number_format($budget->montant, 2, ',', ' ') }} FC
                </p>
            </td>
            <td class="text-center">
                {{ $budget->created_at ? $budget->created_at->format('d/m/Y') : '--' }}
            </td>
            <td class="text-enter"c>
                @php
                    $badgeClass = match($budget->statut) {
                        'Complet' => 'bg-success text-white',
                        'Non soumis' => 'bg-danger text-white',
                        'Consolidé et non soumis' => 'bg-secondary text-white',
                        'Soumis au DG' => 'bg-dark text-white',
                        '' => 'bg-warning text-dark',
                        default => 'bg-secondary text-white',
                    };
                @endphp
                <span class="badge {{ $badgeClass }} text-xs">{{ $budget->statut }}</span>
            </td>
            <td>
                <a href="">Voir les details</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
