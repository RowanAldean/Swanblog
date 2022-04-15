import React from 'react';
import Authenticated from '@/Layouts/Authenticated';
import { Head } from '@inertiajs/inertia-react';


export default function CreatePost(props) {
    return (
        <Authenticated
            auth={props.auth}
            errors={props.errors}
        >
            <Head title="New Post" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="post">
                        <form className='rounded-full'>
                            <div className='form-label-group'>
                                <label htmlFor="caption">Post Content</label><br></br>
                                <textarea id="caption" className='rounded-md' placeholder="What's on your mind?" />
                            </div>
                            <button className="btn" type='submit'>Create Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </Authenticated>
    );
}
