<div class="search-result-item gc">
    <div class="search-image">
    	<img src="<?php print file_create_url($node->field_image['es'][0]['uri']); ?>" width="145" height="150"></img>
    </div>
  <div class="commerce-product-field commerce-product-field-field-con-descuento field-field-con-descuento node-74-product-field-con-descuento">
    <div class="field field-type-list-boolean">
      Con descuento
    </div>
  </div>
  <div class="group-left">
    <h3>
      <?php print l($node->title, 'node/' . $node->nid); ?>
    </h3> <!-- field field-type-text -->
    <div class="commerce-product-field commerce-product-field-commerce-price field-commerce-price node-<?php print $node->nid ?>-product-commerce-price">
      <div class="field field-type-commerce-price">
        <table class="commerce-price-rrp-your-price">
          <tbody>
            <tr class="odd">
              <?php
                $product = commerce_product_load($node->field_product['und'][0]['product_id']);
                if ( isset($product->field_con_descuento['und'][0]['value']) && $product->field_con_descuento['und'][0]['value'] == 1) {
                  print "<td class=\"webprice-total\">" . commerce_currency_format($product->commerce_price['und'][0]['amount'], $product->commerce_price['und'][0]['currency_code']) . "</td>";
                  $price = commerce_product_calculate_sell_price($product);
                  print "<td class=\"rrp-total\">" . commerce_currency_format($price['amount'], $price['currency_code']) . "</td>";
                }
                else {
                  $price = commerce_product_calculate_sell_price($product);
                  print "<td class=\"webprice-total\">" . commerce_currency_format($price['amount'], $price['currency_code']) . "</td>";
                }
              ?>
            </tr>
          </tbody>
        </table>
      </div>
    </div> <!-- commerce-product-field -->
  </div> <!-- group-left -->
</div> <!-- search-result-item -->
