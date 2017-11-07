{extends 'Views/base_layout.tpl'}

{block name='head'}
    
    <style>
        
     th.rotate {
  /* Something you can count on */
  height: 140px;
  white-space: nowrap;
}

th.rotate > div {
  transform: 
    /* Magic Numbers */
    translate(25px, 51px)
    /* 45 is really 360 - 45 */
    rotate(315deg);
  width: 30px;
}
th.rotate > div > span {
  border-bottom: 1px solid #ccc;
  padding: 5px 10px;
}
        
        
    </style>
    
{/block}

{block name='content'}
        <h2 align='center'>Nadgodziny</h2>
        <h2 align='center'>2015</h2>

        <table class='gridtable centre' style='margin-top: 100px'>
            <tr>
                <td style='border: none'>&nbsp;</td>
{foreach $report->projects as $project}
                <th style='background: none; border: none' class="rotate"><div><span>
                    <a href='{$SITE_URL}Projects/report/{$project.id}/'>
                        {$project.name}
                    </a>
                </span></div></th>
{/foreach}
{foreach $report->project3Tasks as $project3Task}
                <th style='background: none; border: none' class="rotate"><div><span>
                    <a href='{$SITE_URL}Projects/report/3/'>
                        {$project3Task.name}
                    </a>
                </span></div></th> 
{/foreach}
            </tr>
{foreach $report->users as $user}
            <tr>
                <th>
                    <a href='{$SITE_URL}UserMonth/index/{$user.id}/{$report->yearTo}/{$report->monthTo}/'>
                        {$user.name}
                    </a>
                </th>
{foreach $report->leftTableContent[$user@index] as $dur}
                <td>{if $dur}{$dur}h{else}&nbsp;{/if}</td>
{/foreach}
{foreach $report->rightTableContent[$user@index] as $dur}
                <td>{if $dur}{$dur}h{else}&nbsp;{/if}</td>
{/foreach}
                <th>{$report->verticalTotals[$user@index]}h</th>
            </tr>
{/foreach}
            <tr>
                <td style='border: none'>&nbsp;</td>
{foreach $report->leftHorizontalTotals as $total}
                <th>{$total}h</th>
{/foreach}
{foreach $report->rightHorizontalTotals as $total}
                <th>{$total}h</th>
{/foreach}
                <th>{$report->totalsTotals}h</th>
            </tr>
        </table>
{/block}

{block name='body_end'}
   

{/block}