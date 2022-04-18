function setColors(_this, status) {
    //if liked
    if (status) {
        _this.classList.add = "text-red-500";
        _this.classList.remove = "text-muted";
    }
    else {
        _this.classList.add = "text-muted";
        _this.classList.remove = "text-red-500";
    }
}

window.giveLike = function (likeStatus) {
    return {
        formData: {
            likeable_type: '',
            id: ''
        },
        liked: likeStatus,
        numberLikes: '',
        ...submitData,
    }
}

const submitData = {
    submitData() {
        console.log(this.formData.likeable_type);
        console.log(this.formData.id);
        console.log(this.liked);
        if (this.liked == true) {
            fetch('/like', {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify(this.formData)
            })
                .then(res => res.json())
                .then(data => {
                    this.numberLikes = data.likes;
                })
                .catch(() => {
                    this.numberLikes = 'ACTION FAILED'
                })
                .finally(() => {
                    this.liked = !this.liked;
                })


        } else if (this.liked == false) {
            fetch('/like', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                },
                body: JSON.stringify(this.formData)
            })
                .then(res => res.json())
                .then(data => {
                    this.numberLikes = data.likes;
                })
                .catch(() => {
                    this.numberLikes = 'ACTION FAILED'
                })
                .finally(() => {
                    this.liked = !this.liked;
                })
        }
    }
}
window.submitData = submitData;