

function Features({img, title, description}){
    return(
        <div>
            
                <img class="s8_icons centerRelative" src={img}/>
                <h4 class="mt_1 text-center s8_titles">{title}</h4>
                <p class="text-center mt_1">{description}</p>
            

        </div>
    )
}



