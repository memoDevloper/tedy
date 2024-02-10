<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">بطاقة مستفيد</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <?php
                $cardDetails = explode('-', $dir4);
                $cardId = $cardDetails[0];
                $beneficiaryId = $cardDetails[1];
                $card = $wam->dbm->getData(['beneficiaries A', 'cards B'], [
                    'A.name',
                    'A.name_ar',
                ], [
                    'join' => [
                        'type' => 'left',
                        'on' => ['A.id', 'B.beneficiary']
                    ],
                    'eq' => ['A.id' => $beneficiaryId, 'B.id' => $cardId]
                ]);
                $card = $card[0];
                ?>
                <h3><?php echo $card->name; ?> - <?php echo $card->name_ar; ?></h3>
            </div>
        </div>
    </div>
</div>