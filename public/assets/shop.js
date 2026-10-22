document.addEventListener('DOMContentLoaded', () => {
 const cards=[...document.querySelectorAll('.product-card')];
 const grid=document.getElementById('products'); const search=document.getElementById('search'); const sort=document.getElementById('sort'); const results=document.getElementById('results'); const empty=document.getElementById('empty');
 let category='Tous', onlyFav=false;
 let favorites=[]; try {favorites=JSON.parse(localStorage.getItem('maisonrose-favs')||'[]'); if(!Array.isArray(favorites)) favorites=[];}catch(e){}
 const save=()=>{localStorage.setItem('maisonrose-favs',JSON.stringify(favorites)); document.getElementById('favCount').textContent=favorites.length; document.querySelectorAll('[data-favorite]').forEach(b=>{const on=favorites.includes(b.dataset.favorite); b.textContent=on?'♥':'♡';b.classList.toggle('liked',on);b.setAttribute('aria-pressed',String(on));});};
 document.querySelectorAll('[data-favorite]').forEach(b=>b.addEventListener('click',()=>{const id=b.dataset.favorite;favorites=favorites.includes(id)?favorites.filter(x=>x!==id):[...favorites,id];save();filter();}));
 document.getElementById('favToggle').addEventListener('click',()=>{if(!grid){location.href='?page=catalog#collection';return;}onlyFav=!onlyFav;document.getElementById('favToggle').classList.toggle('liked',onlyFav);filter();});
 function filter(){if(!grid)return;const q=(search?.value||'').toLocaleLowerCase('fr').trim();let shown=cards.filter(c=>(category==='Tous'||c.dataset.category===category)&&c.dataset.name.includes(q)&&(!onlyFav||favorites.includes(c.querySelector('[data-favorite]').dataset.favorite)));
 cards.forEach(c=>c.hidden=!shown.includes(c));if(sort){shown.sort((a,b)=>sort.value==='asc'?Number(a.dataset.price)-Number(b.dataset.price):sort.value==='desc'?Number(b.dataset.price)-Number(a.dataset.price):sort.value==='az'?a.dataset.name.localeCompare(b.dataset.name,'fr'):cards.indexOf(a)-cards.indexOf(b));shown.forEach(c=>grid.appendChild(c));}
 if(results)results.textContent=shown.length+' article'+(shown.length>1?'s':'')+(onlyFav?' dans tes favoris':'');if(empty)empty.hidden=shown.length!==0;}
 document.querySelectorAll('.filter').forEach(b=>b.addEventListener('click',()=>{category=b.dataset.filter;document.querySelectorAll('.filter').forEach(x=>x.classList.toggle('active',x===b));filter();}));
 search?.addEventListener('input',filter);sort?.addEventListener('change',filter);save();filter();
 const observer=new IntersectionObserver(entries=>entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');observer.unobserve(e.target);}}),{threshold:.06});document.querySelectorAll('.reveal').forEach(el=>observer.observe(el));
});
