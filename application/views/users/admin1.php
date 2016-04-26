<script src="/js/lib/watable/jquery.watable.js"></script>
<link rel='stylesheet' href='js/lib/watable/watable.css' />

<style>
    .sort th:first-child, .watable td:first-child{
        width: 72px;
        text-align: center;
    }

    .sort th:last-child, .watable td:last-child{
        width: 72px;
        text-align: center;
    }

</style>

<div id="tableContant"></div>

<?php if(!empty($table)): ?>

    <?php
    foreach($table as $row){ $url = site_url('/adminka/save/'.$row['id']);

        $checkedOn = $row['ban']==1?'primary':'default';
        $checkedOf = $row['ban']==0?'danger':'default';
        $check  = '<div class="btn-group btn-group-xs" role="group" aria-label="...">
  <button type="button" class="btn btn-'.$checkedOn.' on1" data="'.$row['id'].'" vall="'.$checkedOn.'">On</button>
  <button type="button" class="btn btn-'.$checkedOf.' off1"  data="'.$row['id'].'" vall="'.$checkedOf.'">Off</button>
</div>';

        $blog[] = [
            'ban'  => $check,
            'login' => $row['login'],
            'delete'  => '<div class="del"><img src="/img/delete.png" data="'.$row['id'].'"></div>'
        ];
    }
    $blog = json_encode($blog);
    ?>

    <script type="text/javascript">
        function generateSampleData(varJson){
            var cols = {
                ban: {
                    index: 1,
                    type: "string",
                    friendly: 'Ban',
                    filter: false
                },
                login: {
                    index: 2,
                    //type: "number",
                    type: "string",
                    friendly: 'Логин'
                    //unique: true,
                    //filter: false
                },
                delete: {
                    index: 3,
                    type: "string",
                    friendly: 'Удалить',
                    filter: false
                },
            };
            //var rows = varJson;

            var data = {
                cols: cols,
                rows: varJson
            };
            return data;
        }

        $(document).ready( function() {
            var waTable = $('#tableContant').WATable({
                pageSizes: [1,5,10,20,100],
                filter: true
            }).data('WATable');
            waTable.setData(generateSampleData(<?=$blog?>));  //Sets the data.

            $('.off1').on('click', function(){
                var id = $(this).attr('data');
                var vall = $(this).attr('vall');
                if(vall == 'default'){
                    $(this).removeClass('btn-default');
                    $(this).addClass('btn-danger');
                    $(this).prev().removeClass('btn-primary');
                    $(this).prev().addClass('btn-default');
                    $(this).prev().attr('vall', 'default');
                }
                $.ajax({
                    url:      '/adminka/ban',
                    type:     'post',
                    data:     {'id': id, 'ban': 0}
                });
                //console.clear();
            });

            $('.on1').on('click', function(){
                var id = $(this).attr('data');
                var vall = $(this).attr('vall');
                if(vall == 'default'){
                    $(this).removeClass('btn-default');
                    $(this).addClass('btn-primary');
                    $(this).next().removeClass('btn-danger');
                    $(this).next().addClass('btn-default');
                    $(this).next().attr('vall', 'default');
                }

                $.ajax({
                    url:      '/adminka/ban',
                    type:     'post',
                    data:     {'id': id, 'ban': 1}
                });
                //console.clear();
            })
        });
    </script>

<?php endif; ?>