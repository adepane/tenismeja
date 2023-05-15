<script>
    const locUrl = window.location.pathname.split('/').slice(1);
    const newLoc = `/${locUrl[0]}/#/${locUrl[1]}`;
    window.location.href = newLoc;
</script>