<style>
    :root {
        --smartrecruiters-table-color: <?php echo $params->color ?>;
        --smartrecruiters-table-color-second: #eeeeee;
        --smartrecruiters-table-color-form: #676767;
        --smartrecruiters-table-color-border: #cccccc;
        --smartrecruiters-table-color-header: #333333;
        --smartrecruiters-table-color-row-lighter: #ffffff;
        --smartrecruiters-table-color-row-darker: #e0e0e0;
        --smartrecruiters-table-color-text: #1e1e1e;
        --smartrecruiters-table-color-text-hover: <?php echo $params->textHoverColor ?>;
    }
</style>
<div class="smartrecruiters">
    <div class="smartrecruiters__templates" style="display: none">
        <div class="smartrecruiters__template smartrecruiters__template--filter">
            <div class="smartrecruiters__filter">
                <div class="smartrecruiters__search">
                    <input type="text" class="smartrecruiters__search-input" placeholder="<?php if(!empty($params->searchPlaceholder)) echo $params->searchPlaceholder ?>">
                </div>
                <div class="smartrecruiters__categories">
                    <div class="smartrecruiters__select">
                        <select name="smartrecruiters-categories-filter" class="smartrecruiters__categories-filter">
                            <option selected value="all"><?php echo $params->filterDefault ?><span></span></option>
                            {{categories}}
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="smartrecruiters__template smartrecruiters__template--table">
            <table class="smartrecruiters__table">
                <tbody>
                <?php if(!empty($params->titleName) || !empty($params->titleType) || !empty($params->titleCategory)): ?>
                    <tr class="smartrecruiters__table-header">
                        <th class="smartrecruiters__table-cell"><?php echo $params->titleName ?></th>
                        <th class="smartrecruiters__table-cell"><?php echo $params->titleType ?></th>
                        <th class="smartrecruiters__table-cell"><?php echo $params->titleCategory ?></th>
                    </tr>
                <?php endif ?>
                </tbody>
            </table>
        </div>
        <table class="smartrecruiters__template smartrecruiters__template--table-row">
            <tbody>
                <tr class="smartrecruiters__table-row" data-href="#link" data-target="__blank">
                    <td class="smartrecruiters__table-cell">
                        <a href="#link" target="_blank">{{name}}</a>
                        {{name}}
                    </td>
                    <td class="smartrecruiters__table-cell">{{type}}</td>
                    <td class="smartrecruiters__table-cell" data-category="{{category}}">{{categoryLabel}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="smartrecruiters__filter-table"></div>
</div>