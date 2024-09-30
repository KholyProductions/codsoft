

function Doc({doc, href_val, img, del_fc, style}){
    return(
        <div>
            

            <div class="d-flex centerText_vertically mt_1">
                <p><a href={href_val} download>{doc}</a></p>
                <img  onClick={del_fc} src={img} class={style} />
            </div>

        </div>
    )
}



